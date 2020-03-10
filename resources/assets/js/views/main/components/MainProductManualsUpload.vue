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

      <span>files: {{ this.files.length }}</span>

      <table class="table is-bordered is-fullwidth">
        <tr v-for="(file, key) in files" :key="key">
          <td>{{ file.name }}</td>
          <td style="text-align:right;">
            <button v-on:click="removeFile( key )">x</button>
          </td>
        </tr>
      </table>

      <div>
        <button class="button is-small is-primary is-outlined" v-on:click="addFiles()">Add Files</button>
        <button class="button is-small is-primary" v-on:click="submitFiles()">
          <span class="file-icon">
            <i class="fa fa-upload"></i>
          </span>
          Upload Files
        </button>
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
    feedbackData() {
      if (this.$store.state.feedbackData) {
        return this.$store.state.feedbackData;
      }
    }
  }
};
</script>
<style>
</style>