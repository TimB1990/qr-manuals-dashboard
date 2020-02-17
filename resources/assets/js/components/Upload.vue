<template>
  <div class="container">
    <div class="columns">
      <div class="column">
        <!-- upload elements -->
        <div class="file is-medium is-info has-name is-centered is-boxed">
          <label class="file-label">
            <input
              class="file-input"
              type="file"
              name="resume"
              accept="application/pdf"
              ref="files"
              multiple v-on:change="handleFileUploads()"
            />
            <span class="file-cta" @click="submitFiles()">
              <span class="file-icon">
                <i class="fa fa-upload"></i>
              </span>
              <span class="file-label">Upload PDF</span>
            </span>
            <input
              type="text"
              style="text-align:center;"
              class="file-name"
              placeholder="files..."
            />
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "upload",
  data() {
    return {
      files: ""
    };
  },
  methods: {
    handleFilesUpload() {
      this.files = this.$refs.files.files;
    },
    submitFiles() {
      let formData = new FormData();

      /* iterate over any file sent over appending the files to the form data */
      for(var i = 0; i < this.files.length; i++){
          let file = this.files[i];

          formData.append('files[' + i + ']', file);
      }

      // make request to /pdf-upload URL
      axios
        .post("/pdf-uploads", formData, {
          headers: {
            "Content-Type": "mutlipart/form-data"
          }
        })
        .then(() => {
          console.log("SUCCESS!!");
        })
        .catch(e => {
          console.log("FAILURE: " + e);
        });
    }
  }
};
</script>  