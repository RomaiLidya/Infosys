import React, { FC } from 'react';
import NumberFormat from 'react-number-format';

interface NumberFormatMask {
  inputRef: (instance: NumberFormat | null) => void;
  onChange: (event: { target: { value: string } }) => void;
}

const NumberFormatMask: FC<NumberFormatMask> = props => {
  const { inputRef, onChange, ...other } = props;

  return (
    <NumberFormat
      {...other}
      getInputRef={inputRef}
      onValueChange={values => {
        onChange({
          target: {
            value: values.value
          }
        });
      }}
      allowLeadingZeros={false}
      thousandSeparator
      isNumericString
      prefix='Rp'
    />
  );
};

export default NumberFormatMask;
