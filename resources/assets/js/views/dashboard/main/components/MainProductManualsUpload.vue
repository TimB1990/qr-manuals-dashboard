<template>
  <div class="container">
    <div>
      <label>
        <!-- this element is placed outside screen boundaries -->
        <input v-show="false" type="file" id="files" ref="files" multiple v-on:change="handleFilesUpload()" />
      </label>
    </div>

    <table class="content-table">
      <thead>
        <tr>
          <td colspan="2">Upload Manual - files: {{ this.files.length }}</td>
        </tr>
      </thead>

      <tbody v-if="this.files.length">
        <tr v-for="(file, key) in files" :key="key">
          <td>{{ file.name }}</td>
          <td>
            <span class="remove-file" v-on:click="removeFile( key )">x</span>
          </td>
        </tr>
      </tbody>

      <tbody v-else>
        <tr>
          <td colspan="2">No files selected to upload...</td>
        </tr>
      </tbody>

    </table>

    <div class="panel">
        <button :disabled="this.filesPresented" class="panel-btn" v-on:click="submitFiles()">Upload Manuals <i class="fas fa-file-upload"></i></button>
        <button class="panel-btn" v-on:click="addFiles()">Add Manuals</button>
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
      files: []
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
        console.log("file", file);
        formData.append(`files[${i}]`, file);
      }

      this.$store.dispatch("uploadManual", {
        id: this.id,
        formData: formData
      });

      this.files = [];
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
    filesPresented(){
      return this.files.length > 0 ? false : true;
    }
  }
};
</script>