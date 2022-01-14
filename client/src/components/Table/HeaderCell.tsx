import React, { FC } from 'react';
import { TableCell, TableSortLabel, Theme, makeStyles, createStyles } from '@material-ui/core';
import clsx from 'clsx';
import { LabelImportantTwoTone } from '@material-ui/icons';
import TableCellHead from './TableCellHead';

interface Props {
  id?: string;
  pL?: string;
  pR?: string;
  pT?: string;
  pB?: string;
  align?: 'left' | 'center' | 'right' | 'justify' | 'inherit' | undefined;
  verticalAlign?: 'top' | 'middle' | 'bottom';
  isCheckBox?: boolean;
  orderBy?: string;
  order?: 'asc' | 'desc';
  sort?: boolean;
  onRequestSort?: (event: React.MouseEvent<unknown>, property: string) => void;
}

const useStyles = makeStyles((theme: Theme) =>
  createStyles({
    root: {
      padding: 'none'
    },
    visuallyHidden: {
      border: 0,
      clip: 'rect(0 0 0 0)',
      height: 1,
      margin: -1,
      overflow: 'hidden',
      padding: 0,
      position: 'absolute',
      top: 20,
      width: 1
    }
  })
);

const HeaderCell: FC<Props> = props => {
  const { id, pL, pR, pT, pB, order, orderBy, align, sort, onRequestSort } = props;
  const classes = useStyles(props);

  const createSortHandler = (property: string) => (event: React.MouseEvent<unknown>) => {
    onRequestSort!(event, property);
  };

  return (
    <TableCellHead variant='head' align={align} size='small'>
      {sort && sort! ? (
        <TableSortLabel active={orderBy === id} direction={orderBy === id ? order : 'asc'} onClick={createSortHandler(id ? id : '')}>
          {props.children}
          {orderBy === id ? <span className={classes.visuallyHidden}>{order === 'desc' ? 'sorted descending' : 'sorted ascending'}</span> : null}
        </TableSortLabel>
      ) : (
        props.children
      )}
    </TableCellHead>
  );
};

export default HeaderCell;
