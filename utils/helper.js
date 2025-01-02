const bcrypt = require("bcrypt");

const doHash = async (value, salt) => {
    const genSalt = await bcrypt.genSalt(salt);
    const hash = await bcrypt.hash(value, genSalt);
    return hash;
}
const checkPassword = async (password, check) => {
    const hash = await bcrypt.compare(password, check);
    return hash;
};

module.exports = {
    doHash,
    checkPassword
}