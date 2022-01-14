import React, { FC } from 'react';
import { makeStyles } from '@material-ui/core';
import { WHITE, RED, PENDING_COLOR, CONFIRMATION_COLOR } from 'constants/colors';
import clx from 'clsx';

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
  unpaid: {
    background: PENDING_COLOR
  },
  overdue: {
    background: RED
  },
  paid: {
    background: CONFIRMATION_COLOR
  }
});

interface Props {
  status: 'UNPAID' | 'PAID';
  overdue: boolean;
  totalPrice: number;
  totalPay: number;
}

const StatusPayment: FC<Props> = props => {
  const classes = useStyle();

  const status = (value: string) => {
    if (value === 'UNPAID' && !props.overdue) {
      if (props.totalPay > 0) {
        return 'Bayar Sebagian';
      } else {
        return 'Belum Bayar';
      }
    } else if (value === 'UNPAID' && props.overdue) {
      if (props.totalPay > 0) {
        return 'Bayar Sebagian';
      } else {
        return 'Belum Bayar';
      }
    } else {
      return 'Lunas';
    }
  };

  return (
    <span
      className={clx(
        classes.span,
        { [classes.unpaid]: props.status === 'UNPAID' && !props.overdue && 'UNPAID' },
        { [classes.paid]: props.status === 'PAID' },
        { [classes.overdue]: props.status === 'UNPAID' && props.overdue }
      )}
    >
      {status(props.status)}
    </span>
  );
};

export default StatusPayment;
