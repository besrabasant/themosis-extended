import { Ref } from 'react'
import { filter } from "lodash";
import { useState, forwardRef, useEffect } from "@wordpress/element";
import classNames from "classnames";

/**
 * Scrolls Form Page ref into View.
 * 
 * @param {Ref} ref 
 */
const scrollToRef = ref =>
  document
    .querySelector(".admin-page__content")
    .scrollTo(0, ref.current.offsetTop);

/**
 * Renders Form with Pages.
 *
 * @param formPagesWithRefs
 * @param fieldGroups
 * @param formFields
 * @returns {function(*): *}
 */
export const withFormPages = (formPagesWithRefs, fieldGroups, formFields) => {
  return callback => {
    return formPagesWithRefs.map(({ item: formPage, ref }, index) => {
      let formPageClasses = classNames(
        "admin-form__page",
        `admin-form__page--${formPage.id}`,
        {
          "admin-form__page--first": index === 0,
          "admin-form__page--last": index === formPagesWithRefs.length - 1
        }
      );

      /**
       * Form page Component with forward ref.
       */
      const FormPage = forwardRef((props, ref) => {
        return (
          <div ref={ref} className={formPageClasses}>
            <div className="admin-form__page-title">{formPage.title}</div>
            {callback(
              fieldGroups,
              filter(formFields, ["options.page", formPage.id])
            )}
          </div>
        );
      });

      return <FormPage key={`form-page-${formPage.id}`} ref={ref} />;
    });
  };
};


/**
 * Form page nav Commponent.
 * 
 * @param {Ref[]} param0 
 */
export const FormPageNavs = ({ pageRefs }) => {
  let [formPage, setFormPage] = useState(0);

  const prevClickHandler = () => {
    if (formPage > 0) {
      setFormPage(formPage - 1);
    }
  };

  const nextClickHandler = () => {
    if (formPage < pageRefs.length - 1) {
      setFormPage(formPage + 1);
    }
  };

  useEffect(() => {
    if (pageRefs[formPage].ref) {
      scrollToRef(pageRefs[formPage].ref);
    }

    return () => {};
  });

  let formNavPrevClasses = classNames(
    "admin-form-nav",
    "admin-form-nav--prev",
    { "admin-form-nav--inactive": formPage === 0 }
  );
  let formNavNextClasses = classNames(
    "admin-form-nav",
    "admin-form-nav--next",
    { "admin-form-nav--inactive": formPage === pageRefs.length - 1 }
  );

  return (
    <div className="admin-form__page-nav">
      <div onClick={prevClickHandler} className={formNavPrevClasses} />
      <div onClick={nextClickHandler} className={formNavNextClasses} />
    </div>
  );
};
