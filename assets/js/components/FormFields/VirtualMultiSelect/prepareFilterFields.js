import {map, merge} from 'lodash'

export const prepareFilterFields = (filterFields, defaultValues = {}, updateFilters) => {
    return map(filterFields, (field) => merge({}, field, {
            name: null,
            label: null,
            value: defaultValues[field.name],
            attributes: {
                'placeholder': field.label.inner,
                'data-filter-target': field.name,
            },
            handlers: {
                onChange: (value, e) => updateFilters({
                    target: e.target.dataset.filterTarget,
                    value: value
                })
            }
        })
    )
}