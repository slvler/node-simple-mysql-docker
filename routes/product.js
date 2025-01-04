const express = require("express");
const router = express.Router();
const { index, create} = require("../controllers/productController");

router.route('/').get(index);
router.route("/").post(create);

module.exports = router;
