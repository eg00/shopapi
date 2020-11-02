// https://eslint.org/docs/user-guide/configuring

module.exports = {
  root: true,
  // parserOptions: {
  //   parser: 'babel-eslint'
  // },
  env: {
    browser: true,
  },
  extends: [
    'plugin:vue/recommended',
    'plugin:promise/recommended',
    'airbnb-base',
  ],
  plugins: [
    'vue',
    'promise',
  ],
  // add your custom rules here
  rules: {
    'import/no-unresolved': 0,
    // allow async-await
    'generator-star-spacing': 'off',
    // allow debugger during development
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
  },
};
