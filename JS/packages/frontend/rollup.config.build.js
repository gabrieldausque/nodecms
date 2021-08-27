import svelte from 'rollup-plugin-svelte';
import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import { terser } from 'rollup-plugin-terser';
import sveltePreprocess from 'svelte-preprocess';
import typescript from '@rollup/plugin-typescript';
const production = !process.env.ROLLUP_WATCH;
import css from 'rollup-plugin-css-only';

console.log(`Production is : ${production} `);
console.log(`WATCH mode is : ${process.env.ROLLUP_WATCH}`)

export default {
	input: 'src/main.ts',
	treeshake: false,
	output: {
		sourcemap: true,
		format: 'iife',
		name: 'app',
		file: 'public/js/node-cms/bundle.js'
	},
	plugins: [
		svelte({
			preprocess: sveltePreprocess({ sourceMap: false }),
			compilerOptions: {
				dev: false
			}
		}),
		css({ output: 'bundle.css' }),
		resolve({
			browser: true,
			dedupe: ['svelte',
				'@nodecms/backend-data',
				'@nodecms/backend-client']
		}),
		commonjs(),
		typescript({
			sourceMap: false,
			inlineSources: false
		}),
		terser()
	]
};
