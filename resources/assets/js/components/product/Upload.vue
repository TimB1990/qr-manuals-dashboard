<template>
  <div class="container">
    <div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <div class="modal-card-head">
          <input
            class="file-input"
            type="file"
            id="files"
            ref="files"
            accept=".pdf"
            multiple
            v-on:change="handleFilesUpload()"
          />
          <p class="modal-card-title">Upload files</p>
          <button class="delete" aria-label="close" @click="close"></button>
        </div>

        <section class="modal-card-body">
          <strong class="content is-small">files:</strong>
          {{ this.files.length }}
          <div class="columns">
            <div class="column">
              <div v-for="(file, key) in files" class="notification" :key="key">
                <button class="delete" v-on:click="removeFile( key )"></button>
                <div class>{{ file.name }}</div>
              </div>
            </div>
          </div>
        </section>
        <footer class="modal-card-foot">
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
        </footer>
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
      },
      productId: null
    };
  },

  created() {
    // on created this component listens to the event loadDetails send from productsList
    this.$root.$on("product", id => {
      this.productId = id;
      // console.log("id reetrieved by upload.vue", id);
    });
  },

  methods: {
    close() {
      // emit close event to ExtendSearch.vue
      this.$emit("close");
    },

    addFiles() {
      this.$refs.files.click(); // references to element with id of files
    },

    submitFiles() {
      let formData = new FormData();

      for (let i = 0; i < this.files.length; i++) {
        let file = this.files[i];

        formData.append(`files[${i}]`, file); // formData.append(key, value)
      }

      axios
        .post(`/products/${this.productId}/uploads`, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          console.log("SUCCESS!!");
          this.notification.show = true;
          this.notification.message = "OK";
          this.notification.iconClass = "fa fa-check has-text-success";
          // this.files = [];
        })
        .catch(error => {
          console.log("FAILURE!!");
          this.notification.show = true;
          this.notification.message = "FAIL";
          this.notification.iconClass = "fa fa-times has-text-danger";
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