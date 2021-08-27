const path = require('path')
const { WebpackPluginServe } = require('webpack-plugin-serve')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const DotEnvPlugin = require('dotenv-webpack');
const preprocess = require('svelte-preprocess');

exports.devServer = () => ({
    watch: true,
    plugins: [
        new WebpackPluginServe({
            port: 5000,
            static: path.resolve(process.cwd(), 'public'),
            historyFallback: true
        })
    ]
})

exports.generateSourceMaps = ({ type }) => ({ devtool: type })

exports.svelte = mode => {
    const prod = mode === 'production'
    return {
        resolve: {
            alias: {
                svelte: path.dirname(require.resolve('svelte'))
            },
            extensions: ['.mjs', '.js', '.svelte', '.ts'],
            mainFields: ['svelte', 'browser', 'module', 'main']
        },
        module: {
            rules: [
                {
                    test: /\.svelte$/,
                    use: {
                        loader: 'svelte-loader',
                        options: {
                            compilerOptions: {
                                dev: !prod
                            },
                            emitCss: prod,
                            hotReload: !prod,
                            preprocess: preprocess({
                                postcss: true
                            })
                        }
                    }
                },
                {
                    test: /node_modules\/svelte\/.*\.mjs$/,
                    resolve: {
                        fullySpecified: false
                    }
                }
            ]
        }
    }
}
exports.typescript = () => ({
    module: { rules: [{ test: /\.ts$/, use: 'ts-loader', exclude: /node_modules/ }] }
})

exports.postcss = () => ({
    loader: 'postcss-loader'
})

exports.extractCSS = ({ options = {}, loaders = [] } = {}) => {
    return {
        module: {
            rules: [
                {
                    test: /\.(p?css)$/,
                    use: [{ loader: MiniCssExtractPlugin.loader, options }, 'css-loader'].concat(
                        loaders
                    ),
                    sideEffects: true
                }
            ]
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: 'bundle.css'
            })
        ]
    }
}

exports.useDotenv = () => ({
    plugins: [new DotEnvPlugin()]
})