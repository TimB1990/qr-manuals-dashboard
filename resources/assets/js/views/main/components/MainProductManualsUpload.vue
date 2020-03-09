<template>
  <div class="container">
    <div>
      <input
        class="file-input"
        type="file"
        id="files"
        ref="files"
        accept=".pdf"
        multiple
        v-on:change="handleFilesUpload()"
      />
      files: {{ this.files.length }}
      <div v-for="(file, key) in files" class="notification" :key="key">
        <button class="delete" v-on:click="removeFile( key )"></button>
        <div class>{{ file.name }}</div>
      </div>

      <div>
        <button class="button is-small is-primary is-outlined" v-on:click="addFiles()">Add Files</button>
        <button class="button is-small is-primary" v-on:click="submitFiles()">
          <span class="file-icon">
            <i class="fa fa-upload"></i>
          </span>
          Upload Files
        </button>
        <div v-if="feedbackData.show" class="column">
          <transition name="fade">
            <span class="icon is-large">
              <span class="fa-stack fa-lg">
                <i :class="feedbackData.iconClass" aria-hidden="true"></i>
              </span>
            </span>
          </transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "mainProductManualsUpload",
  props: {
    id: Number,
    required: true
  },
  data() {
    return {
      files: [],
    };
  },
  methods: {
    addFiles() {
      this.$refs.files.click();
    },

    submitFiles() {
      let formData = new FormData();

      for (let i = 0; i < this.files.length; i++) {

        let file = this.files[i];
        formData.append(`files[${i}]`, file);
      }

      this.$store.dispatch('uploadManual',{
        id: this.id,
        formData : formData
      });


    },

    handleFilesUpload() {
      let uploadedFiles = this.$refs.files.files;

      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }
    },

    removeFile(key) {
      this.files.splice(key, 1);
    }
  },

  computed: {
    feedbackData(){
      if(this.$store.state.feedbackData){
        return this.$store.state.feedbackData;
      }   
    }
  }
};
</script>
<style>
.fade-enter {
  opacity: 0;
}
.fade-enter-active {
  transition: opacity 1s;
}
.fade-leave {
  opacity: 1;
}
.fade-leave-active {
  transition: opacity 1s;
  opacity: 0;
}
</style>