const { series, parallel, watch } = require('gulp')
const gulp = require('gulp')
const config = require('../config')
// const server = require('../task/server')
const scss = require('../task/scss')
const scssMin = require('../task/scss-min')
const FtpDeploy = require('ftp-deploy');
const ftpDeploy = new FtpDeploy();

const ftpOptions = {
//FTPユーザー名
  user: 'twcm000@test-darcys-factory.xyz',
//FTPパスワード
  password: '1nf0B3n3seed',
//FTPホスト
  host: 'sv13223.xserver.jp',
  port: 21,
//アップロードフォルダを指定
  localRoot: process.cwd() + "/assets/css",
//サーバーのアップロード先を指定
  remoteRoot:'/test-darcys-factory.xyz/public_html/html/template/default/assets/css',
  include: ['*'],
  deleteRemote: false
}

gulp.task("staging", function(done) {
  ftpDeploy.deploy(ftpOptions, (error) => {
    if (error) {
      console.log("Error", error);
    }
  });
  done();
});

module.exports = series(parallel(scss, scssMin), () => {
  watch(config.paths.source.template + config.paths.assets.scss, series(parallel(scss, scssMin), ["staging"]))
})
