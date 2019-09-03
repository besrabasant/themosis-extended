/**
 * @typedef FormAttributes
 * @property {string} method
 * @property {string} class
 * @property {boolean} novalidate
 */

/**
 * @typedef FormFieldAttributes
 */

/**
 * @typedef FormField
 */

/**
 * @typedef FormFieldGroup
 */

/**
 * @typedef FormValidation
 * @property {boolean} errors
 * @property {boolean} isValid
 */

/**
 * @typedef FormConfig
 * @property {string} name
 * @property {string} locale
 * @property {string} type
 * @property {boolean} flush
 * @property {string} value
 * @property {FormAttributes} attributes
 * @property {string} nonce
 * @property {string} nonce_value
 * @property {boolean} referer
 * @property {string} referer_value
 * @property {string} csrf_token
 * @property {FormField[]} fields
 * @property {FormFieldGroup[]} groups
 * @property {FormValidation} validation
 */