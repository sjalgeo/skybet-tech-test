var webpack = require('webpack');

const REMOTE_SCRIPTS_DIR = './public/scripts';

module.exports = {
	entry: [
		'./src/app.js'
	],
	devtool: process.env.WEBPACK_DEVTOOL || 'cheap-module-source-map',
	output: {
		path: REMOTE_SCRIPTS_DIR,
		filename: "app.min.js"
	},
	module: {
		loaders: [
			{
				exclude: /node_modules/,
				loader: 'babel',
				query: {
					presets: ['react','es2015', "stage-1"]
				}
			}
		]
	}
};