const bcrypt = require("bcrypt");

const doHash = async (value, salt) => {
    const genSalt = await bcrypt.genSalt(salt);
    const hash = await bcrypt.hash(value, genSalt);
    return hash;
}

module.exports = {
    doHash
}