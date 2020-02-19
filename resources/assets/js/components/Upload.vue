<template>
  <div class="container">
    <div class="columns">
      <label>
        <input
          class="file-input"
          type="file"
          id="files"
          ref="files"
          multiple
          v-on:change="handleFilesUpload()"
        />
      </label>
    </div>

    <div class="columns box">
      <button
        class="button is-medium is-fullwidth is-info is-outlined"
        v-on:click="addFiles()"
      >Add Files</button>
    </div>

    <div class="columns box">
      <div class="column">
        <div v-for="(file, key) in files" class="notification" :key="key">
          <button class="delete" v-on:click="removeFile( key )"></button>
          <div class>{{ file.name }}</div>
        </div>
      </div>
    </div>

    <div class="columns box">
      <div class="column is-four-fifths">
        <strong class="content is-medium">files:</strong>
        {{ this.files.length }}
      </div>
      <div class="column">
        <button class="button is-medium is-info" v-on:click="submitFiles()">
          <span class="file-icon">
            <i class="fa fa-upload"></i>
          </span>
          Upload Files
        </button>
      </div>

      <!-- confirmation -->
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
</template>

<script>
export default {
  name: "upload",
  data() {
    return {
      files: [],
      notification: {
        message: "",
        iconClass: "",
        show: false
      }
    };
  },

  /*
      Defines the method used by the component
    */
  methods: {
    afterLeave() {
      this.notification.show = false;
    },
    /*
        Adds a file
      */
    addFiles() {
      this.$refs.files.click();
    },

    /*
        Submits files to the server
      */
    submitFiles() {
      /*
          Initialize the form data
        */
      let formData = new FormData();

      /*
          Iteate over any file sent over appending the files
          to the form data.
        */
      for (let i = 0; i < this.files.length; i++) {
        let file = this.files[i];

        formData.append(`files[${i}]`, file);
      }

      /*
          Make the request to the POST /select-files URL
        */
      axios
        .post("/pdf-files", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          console.log("SUCCESS!!");
          this.notification.show = true;
          this.notification.message = "OK";
          this.notification.iconClass = "fa fa-check has-text-success";
        })
        .catch(error => {
          console.log("FAILURE!!");
          this.notification.show = true;
          this.notification.message = "FAIL";
          this.notification.iconClass = "fa fa-times has-text-danger";
        });
    },

    /*
        Handles the uploading of files
      */
    handleFilesUpload() {
      let uploadedFiles = this.$refs.files.files;

      /*
          Adds the uploaded file to the files array
        */
      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }
    },

    /*
        Removes a select file the user has uploaded
      */
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