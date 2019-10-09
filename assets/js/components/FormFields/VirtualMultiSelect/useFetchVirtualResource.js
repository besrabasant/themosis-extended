import {useState} from "@wordpress/element";
import {useFetch} from "./useFetch";
import {merge} from 'lodash'

/**
 *
 * @param state
 * @param data
 * @returns {*}
 */
const virtualFetchReducer = (state, data) => {
    return data
}


/**
 * Custom hook to fetch Virtual resource.
 *
 * @param attributes
 * @returns {[*, {}, function, *]}
 */
export const useFetchVirtualResource = (attributes) => {
    let [filters, setFilters] = useState({})
    let [result, loading] = useFetch(attributes.options.virtual_resource.endpoint, filters, [], virtualFetchReducer)

    const updateSearchFilters = (updatedFilters) => {

        setFilters(merge({}, filters,
            {
                filters: {
                    [updatedFilters.target]: updatedFilters.value
                }
            }
        ))

    }

    return [result, (filters.filters || {}), updateSearchFilters, loading]
}