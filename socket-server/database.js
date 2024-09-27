const { Sequelize } = require('sequelize');

const sequelize = new Sequelize('chat_system', 'username', 'password', {
    host: 'localhost',
    dialect: 'mysql'
});

module.exports = sequelize;
