const Joi = require("joi");

const storeValidation = Joi.object({
    title: Joi.string()
        .min(6)
        .max(255)
        .required(),
    content: Joi.string().min(6).max(255).required(),
    category_id: Joi.number().min(0).required(),
    status: Joi.string().valid('ACTIVE','PASSIVE').required()
});

const updateValidation = Joi.object({
    title: Joi.string()
        .min(6)
        .max(255)
        .required(),
    content: Joi.string().min(6).max(255).required(),
    category_id: Joi.number().min(0).required(),
    status: Joi.string().valid('ACTIVE','PASSIVE').required()
});


module.exports = {
    storeValidation,
    updateValidation
};
