function renderChoices(choices) {
    return choices.map((choice, index) => {
        return (choice.type === 'group') ?
            (<optgroup key={`optgroup-${index}`} label={choice.key}>{renderChoices(choice.value)}</optgroup>)
            :
            (<option key={`option-${index}`} value={choice.value}>{choice.key}</option>)
    },)
}

export const ChoiceSelectField = ({attributes, value, onChange}) => {
    let {class: classAttr, ...fieldAttributes} = attributes.attributes
    return (
        <select className="form-control" name={attributes.name}
                onChange={onChange} defaultValue={value} {...fieldAttributes}>
            {renderChoices(attributes.options.choices)}
        </select>
    )
}