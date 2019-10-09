function renderRadioOptions(attributes, value, onChange) {
    dd(value)

    return attributes.options.choices.map(choice => {
        return choice.value ? (
            <div key={choice.value} className='field__choice-item'>
                <input type="checkbox" className="field__choice-item-input" value={choice.value}
                       checked={value.includes(choice.value)}
                       name={`${attributes.name}[]`}
                       onChange={onChange}/>
                <label className="field__choice-item-label" htmlFor={attributes.name}>{choice.key}</label>
            </div>
        ) : null
    })
}

export const ChoiceCheckboxField = ({attributes, value, onChange}) => {
    let {class: classAttr, ...fieldAttributes} = attributes.attributes
    return (
        <div className='field__choice-group'>
            {renderRadioOptions(attributes, value, onChange)}
        </div>
    )
}