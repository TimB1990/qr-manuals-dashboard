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
        <div v-if="this.notification.show" class="column">
          <transition name="fade">
            <span class="icon is-large">
              <span class="fa-stack fa-lg">
                <i :class="this.notification.iconClass" aria-hidden="true"></i>
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
      notification: {
        message: "",
        iconClass: ""
      }
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

      axios
        .post(`api/products/${this.id}/manuals`, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          console.log("SUCCESS!!");
          this.notification.show = true;
          this.notification.message = "OK";
          this.notification.iconClass = "fa fa-check has-text-success";
          this.files = [];
        })
        .catch(error => {
          console.log("FAILURE!!");
          this.notification.show = true;
          this.notification.message = "FAIL";
          this.notification.iconClass = "fa fa-times has-text-danger";
        });

        // reload manualslist
        this.$store.dispatch('fetchManuals', {
          id: this.id
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