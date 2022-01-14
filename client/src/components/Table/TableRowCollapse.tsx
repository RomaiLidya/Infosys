import React, { FC } from 'react';
import clsx from 'clsx';
import { GREY } from 'constants/colors';
import { TableCell, Collapse, makeStyles } from '@material-ui/core';
import TableRowCustom from './TableRowCustom';

interface Props {
  colSpan: number;
  open: boolean;
}

const useStyles = makeStyles({
  expand: {
    border: `1px solid ${GREY}`,
    borderRadius: 5
  },
  normal: {
    border: 'none',
    display: 'none'
  },
  row: {
    top: -100
  }
});

const TableRowCollapse: FC<Props> = props => {
  const { expand, normal, row } = useStyles();
  return (
    <TableRowCustom>
      <TableCell colSpan={props.colSpan} className={clsx({ [expand]: props.open, [normal]: !props.open })}>
        <Collapse in={props.open} timeout='auto' unmountOnExit>
          {props.children}
        </Collapse>
      </TableCell>
    </TableRowCustom>
  );
};

export default TableRowCollapse;
