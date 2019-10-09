import {useEffect, useState} from "@wordpress/element";
import {apiFetch} from '../../../utils/apiFetch'
import {REST_REQUEST} from '../../../utils/rest'

/**
 * Default reducer for useFetch
 * @param state
 * @param data
 */
const defaultFetchReducer = (state, data) => {
    return {...state, ...data}
}

/**
 * Hook to fetch data.
 *
 * @param {string} url
 * @param {Object} params
 * @param {null| *}initialData
 * @param {function}dataReducer
 * @returns {[{}, boolean, function, function]}
 */
export const useFetch = (url, params = {}, initialData = null, dataReducer = defaultFetchReducer) => {
    const [data, updateData] = useState(initialData);
    const [loading, setLoading] = useState(true);

    const fetchData = (url, params) => {

        let options = {
            method: REST_REQUEST.POST,
            url,
            data: params,
        }

        if (!loading) {
            setLoading(true)
        }

        return apiFetch(options)
            .finally(() => {
                setLoading(false)
            })
    }

    useEffect(() => {
        fetchData(url, params).then(response => {
            updateData(state => dataReducer(state, response))
        })

    }, [url, params]);

    return [data, loading, updateData, setLoading];
};
