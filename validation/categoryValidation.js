const Joi = require("joi");

const storeValidation = Joi.object({
    name: Joi.string().min(3).max(18).required().messages({
        "string.base": `name should be a type of 'text'.`,
        "string.empty": `name cannot be an empty field.`,
        "string.min": `name should have a minimum length of 3.`,
        "any.required": `name is a required field.`,
    }),
    description: Joi.string().min(3).max(255).required()
});

module.exports = {
    storeValidation,
}