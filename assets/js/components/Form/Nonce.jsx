import {Component} from 'react'

/**
 * @param {FormConfig} formConfig
 * @returns {null | Component}
 * @constructor
 */
export const Nonce = ({formConfig}) => {
    return (formConfig.nonce_value) ? (
        <>
            <input type="hidden" id={formConfig.nonce} name={formConfig.nonce} value={formConfig.nonce_value}/>
            {(formConfig.referer) ? (
                <input type="hidden" name="_wp_http_referrer" value={formConfig.referer_value}/>) : null}
        </>
    ) : null
}