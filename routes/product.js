const express = require("express");
const router = express.Router();
const index = require("../controllers/productController");


router.route('/').get(index);


module.exports = router;
