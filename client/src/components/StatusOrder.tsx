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
  pending: {
    background: PENDING_COLOR
  },
  confirmation: {
    background: CONFIRMATION_COLOR
  }
});

interface Props {
  status: 'PENDING' | 'CANCEL' | 'CONFIRMATION';
}

const StatusOrder: FC<Props> = props => {
  const classes = useStyle();

  const status = (value: string) => {
    switch (value) {
      case 'PENDING':
        return 'Tertunda';
      case 'CANCEL':
        return 'Batal';
      case 'CONFIRMATION':
        return 'Konfirmasi';
    }
  };

  return (
    <span
      className={clx(classes.span, { [classes.pending]: props.status === 'PENDING' }, { [classes.confirmation]: props.status === 'CONFIRMATION' })}
    >
      {status(props.status)}
    </span>
  );
};

export default StatusOrder;
