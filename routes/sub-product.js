const express = require("express");
const router = express.Router();
const { index, create, show, update } = require("../controllers/subProductController.js");


router.route('/').get(index);
router.route('/').post(create);
router.route('/:id').get(show);
router.route('/:id').put(update);


module.exports = router;
