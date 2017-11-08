var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'SoundBox', subTitle: 'Chat Application' });
});

module.exports = router;
