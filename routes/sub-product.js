const express = require("express");
const router = express.Router();
const { index, create, show, update, destroy } = require("../controllers/subProductController.js");

router.route('/').get(index);
router.route('/').post(create);
router.route('/:id').get(show);
router.route('/:id').put(update);
router.route("/:id").delete(destroy);


module.exports = router;
