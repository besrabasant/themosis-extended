import {useState} from "@wordpress/element";
import {map, reject, concat, times, keys} from "lodash"
import uuid from "uuidv4"
import {FieldWrapper} from '../FieldWrapper';
import {renderFields} from '../../AdminForm/renderFields'

function getProtoTypeInstanceUuid(attributes, index, uuid) {
    if (attributes.value.length && attributes.value[index]) {
        return attributes.value[index].id
    }
    return uuid
}

function createProtoTypeInstance(prototype, attributes, index, uuid) {
    return map(prototype, function (prototypeField) {
        return Object.assign({}, prototypeField, {
            name: `${attributes.name}[${index}][${prototypeField.name}]`,
            value: (attributes.value[index]) ? attributes.value[index][prototypeField.name] : prototypeField.default,
            attributes: {
                id: `${prototypeField.attributes.id}_${index}`
            }
        })
    })
}

const RepeaterFieldItem = ({uuid, index, prototype, attributes, onChange, removeItemHandler, disableRemoveitem}) => {

    let protoTypeInstance = createProtoTypeInstance(prototype, attributes, index, uuid)

    function onRemoveButtonClick(e) {
        e.preventDefault()
        e.stopPropagation()
        removeItemHandler(uuid)
    }

    return (
        <div className="repeater-field__item">
            <div className="repeater-field__item_index">
                {index + 1})
            </div>
            <div className="repeater-field__item-content">
                <input type="hidden"
                       name={`${attributes.name}[${index}][id]`}
                       value={getProtoTypeInstanceUuid(attributes, index, uuid)}/>
                {renderFields(protoTypeInstance)}
            </div>
            <div className="repeater-field__item-actions">
                <button disabled={disableRemoveitem}
                        className="repeater-field__item-action repeater-field__item-action--delete button"
                        title={attributes.options.remove_item_label}
                        onClick={onRemoveButtonClick}>
                    <span className="dashicons dashicons-trash"/>
                </button>
            </div>
        </div>
    )
}

function getRepeaterFieldRenderableitems(attributes) {
    let lengthofValues = (attributes.value.length === undefined) ? keys(attributes.value).length : attributes.value.length

    return (lengthofValues > attributes.options.min_items) ? lengthofValues : attributes.options.min_items
}

export const RepeaterField = ({attributes}) => {

    // console.log(attributes)

    let repeaterFieldRenderableitems = getRepeaterFieldRenderableitems(attributes)

    let initialState = times(repeaterFieldRenderableitems, (key) => {
        return {
            id: uuid()
        }
    })

    let [answerValues, setAnswerValues] = useState(initialState)

    function addNewAnswer(e) {
        e.preventDefault()
        e.stopPropagation()

        setAnswerValues(concat(answerValues, {id: uuid()}))
    }

    function removeAnswer(id) {
        setAnswerValues(reject(answerValues, {id}))
    }

    let disableAddItem = (attributes.options.max_items && answerValues.length >= attributes.options.max_items)

    return (
        <FieldWrapper attributes={attributes} infoPosition="top">
            <div className="repeater-field">
                <button disabled={disableAddItem} className="button repeater-field__add-item-action"
                        title={attributes.options.add_item_label}
                        onClick={addNewAnswer}>
                    <span className="dashicons dashicons-plus-alt"/>
                </button>
                <div className="repeater-field__content">
                    {
                        map(answerValues, ({id}, index) => {
                            return (<RepeaterFieldItem key={id} uuid={id} index={index} removeItemHandler={removeAnswer}
                                                       attributes={attributes} prototype={attributes.prototype}
                                                       disableRemoveitem={(answerValues.length <= attributes.options.min_items)}/>)
                        })
                    }
                </div>
            </div>
        </FieldWrapper>
    )
}