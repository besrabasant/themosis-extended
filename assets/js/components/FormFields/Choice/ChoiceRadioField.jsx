
function renderRadioOptions(attributes, value, onChange) {
    return attributes.options.choices.map(choice => {
        return choice.value ? (
            <div key={choice.value} className='field__choice-item'>
                <input type="radio" className="field__choice-item-input" value={choice.value}
                       checked={(choice.value === value)}
                       name={attributes.name}
                       onChange={onChange}/>
                <label className="field__choice-item-label" htmlFor={attributes.name}>{choice.key}</label>
            </div>
        ) : null
    })
}

export const ChoiceRadioField = ({attributes, value, onChange}) => {
    let {class: classAttr, ...fieldAttributes} = attributes.attributes
    return (
        <div className='field__choice-group'>
            {renderRadioOptions(attributes, value, onChange)}
        </div>
    )
}