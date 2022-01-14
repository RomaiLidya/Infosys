import React, { FC } from 'react';
import { makeStyles } from '@material-ui/core';
import clx from 'clsx';
import { WHITE, PENDING_COLOR, CONFIRMATION_COLOR } from 'constants/colors';

const useStyle = makeStyles({
  span: {
    padding: '5px 12px 5px 12px',
    borderRadius: '100px',
    fontFamily: 'Rubik',
    fontStyle: 'normal',
    fontWeight: 500,
    fontSize: '15px',
    lineHeight: '22px',
    color: WHITE
  },
  unavailable: {
    background: PENDING_COLOR
  },
  available: {
    background: CONFIRMATION_COLOR
  }
});

interface Props {
  status: 'UNAVAILABLE' | 'AVAILABLE';
}

const InvoicePlafonStatus: FC<Props> = props => {
  const classes = useStyle();

  const status = (value: string) => {
    switch (value) {
      case 'UNAVAILABLE':
        return 'Tidak Ada';
      case 'AVAILABLE':
        return 'Ada';
    }
  };

  return (
    <span
      className={clx(classes.span, { [classes.unavailable]: props.status === 'UNAVAILABLE' }, { [classes.available]: props.status === 'AVAILABLE' })}
    >
      {status(props.status)}
    </span>
  );
};

export default InvoicePlafonStatus;
