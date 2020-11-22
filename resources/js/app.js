require("./bootstrap");
import "alpinejs";

import './components/website.create'
import './components/website.ftp';

import Vue from 'vue';
import FtpUpload from './components/ftpUpload';

new Vue({
  el: '#ftp-upload',
  components: { FtpUpload }
});