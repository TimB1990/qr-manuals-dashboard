<template>
  <div class="container">
    <div>
      <label>
        <!-- this element is placed outside screen boundaries -->
        <input v-show="false" type="file" id="files" ref="files" multiple v-on:change="handleFilesUpload()" />
      </label>
    </div>

    <table class="upload-files-container">
      <thead class="upload-header">
        <tr>
          <td>Upload Manual</td>
          <td>files: {{ this.files.length }}</td>
        </tr>
      </thead>

      <tbody class="file-listing" v-if="this.files.length">
        <tr v-for="(file, key) in files" :key="key">
          <td>{{ file.name }}</td>
          <td>
            <span class="remove-file" v-on:click="removeFile( key )">x</span>
          </td>
        </tr>
      </tbody>

      <tbody v-else class="file-listing">
        <tr>
          <td colspan="2">No files selected to upload...</td>
        </tr>
      </tbody>

    </table>

    <div class="upload-button-panel">
        <button :disabled="this.filesPresented" class="panel-button" v-on:click="submitFiles()">Upload Manuals <i class="fas fa-file-upload"></i></button>
        <button class="panel-button" v-on:click="addFiles()">Add Manuals</button>
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
<style>
input[type="file"] {
  position: absolute;
  top: -500px;
}

.file-listing {
  width: 100%;
}

.remove-file {
  font-weight: bolder;
  cursor: pointer;
  float: right;
}

.upload-files-container{
  border: 1px solid hsl(0,0%,80%);
}

.upload-header {
  background-color: #cc0033;
  color: white;
}

.upload-header > tr > td {
  padding-left: 12px;
  padding-right: 12px;
  padding-top: 6px;
  padding-bottom: 6px;
}

.upload-header > tr > td:nth-child(2){
  text-align: right;
}

.file-listing > tr > td {
  padding-left: 12px;
  padding-right: 12px;
  padding-top: 6px;
  padding-bottom: 6px;
  font-size: 14px;
}

.upload-button-panel {
  display: flex;
  /*border: 1px solid hsl(0,0%,80%);*/
  flex-direction: row-reverse;
  margin-top: 12px;
}

.panel-button {
  background-color: transparent;
  border: 1px solid hsl(0, 0%, 76%);
  color: #363636;
  width: 150px;
  padding: 6px 12px 6px 12px;
  border-radius: 3px;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  outline: none;
  margin-right: 12px;
  /*box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1), 0 0px 0 1px rgba(10, 10, 10, 0.02);*/
}

.panel-button:hover{
  border: 1px solid black;
  color: black;
}

.panel-button:disabled{
  background-color: hsl(0,0%,98%);
  pointer-events: none;
}

.panel-button:disabled > i{
  color: grey;
}

</style>