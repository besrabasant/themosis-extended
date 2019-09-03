import {Component} from 'react'

/**
 * @param {FormConfig} formConfig
 * @returns {null | Component}
 * @constructor
 */
export const Csrf = ({formConfig}) => {
    return (formConfig.nonce_value) ? (<input type="hidden" name="_token" value={formConfig.csrf_token}/>) : null
}