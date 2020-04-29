<template>

  <div id="profile-pic-demo" class="bg-light pt-3">
    <VueFileAgent
      class="profile-pic-upload-block"
      ref="profilePicRef"
      :multiple="false"
      :deletable="false"
      :meta="false"
      :compact="true"
      :accept="'image/*'"
      :helpText="'Drag an image file here'"
      :errorText="{
        type: 'Please select an image',
      }"
      v-model="profilePic"
      @select="onSelect($event)"
    >
      <template v-slot:after-inner>
        <span title="after-inner" class="btn btn-link btn-sm btn-block">Select image file</span>
      </template >
      <template v-slot:after-outer>
        <div title="after-outer">
          <p>Please select an image and click the upload button</p>
          <div class="drop-help-text">
            <p class="text-success">Drop the file!</p>
          </div>
          <button type="button" class="btn btn-primary" :class="{'disabled': uploaded || !profilePic}" @click="upload()">Upload</button>
          <button type="button" class="btn" :class="[uploaded ? 'btn-danger' : 'btn-secondary']" v-if="profilePic" @click="removePic()">Remove</button>
          <div class="clearfix"></div>
        </div>
      </template >
    </VueFileAgent>
  </div>
</template>
<script>
  export default {
    data: function(){
      return {
        name: 'Gapal',
        profilePic: null,
        uploaded: false,
        uploadUrl: 'https://www.mocky.io/v2/5d4fb20b3000005c111099e3',
        uploadHeaders: {},
      }
    },
    methods: {
      removePic: function(){
       var profilePic = this.profilePic;
        this.$refs.profilePicRef.deleteUpload(this.uploadUrl, this.uploadHeaders, [profilePic]);
        this.profilePic = null;
        this.uploaded = false;
      },
      upload: function(){
        var self = this;
        this.$refs.profilePicRef.upload(this.uploadUrl, this.uploadHeaders, [this.profilePic]).then(function(){
          self.uploaded = true;
          setTimeout(function(){
            self.profilePic.progress(0);          
          }, 500);
        });
      },
      onSelect: function(fileRecords){
        this.uploaded = false;
      }
    }
  }
</script>
<style>
  #profile-pic-demo .drop-help-text {
    display: none;
  }
  #profile-pic-demo .is-drag-over .drop-help-text {
    display: block;
  }
  #profile-pic-demo .profile-pic-upload-block {
    border: 2px dashed transparent;
    padding: 20px;
    padding-top: 0;
  }

  #profile-pic-demo .is-drag-over.profile-pic-upload-block {
  border-color: #AAA;
  }

  #profile-pic-demo .vue-file-agent {
  width: 180px;
  float: left;
  margin: 0 15px 5px 0;
  border: 0;
  box-shadow: none;
  }
</style>