const express = require("express");
const router = express.Router();

const { index, show } = require("../controllers/categoryController.js");

router.route("/").get(index);
router.route("/:id").get(show);

module.exports = router;
