const express = require("express");
const router = express.Router();

const { index, show, store, destroy } = require("../controllers/categoryController.js");

router.route("/").get(index);
router.route("/:id").get(show);
router.route("/").post(store);
router.route("/:id").delete(destroy);

module.exports = router;
