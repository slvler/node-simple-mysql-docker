const express = require("express");
const router = express.Router();

const { index, show, store, update, destroy } = require("../controllers/blogController.js");

router.route("/").get(index);
router.route("/:id").get(show);
router.route("/").post(store);
router.route("/:id").put(update);
router.route("/:id").delete(destroy);

module.exports = router;
