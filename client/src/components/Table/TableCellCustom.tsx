import { withStyles, createStyles, Theme, TableCell } from '@material-ui/core';
import { GREY, BLACK_2 } from 'constants/colors';

const TableCellStart = withStyles((theme: Theme) =>
  createStyles({
    root: {
      border: `1px solid ${GREY}`,
      borderTopLeftRadius: 5,
      borderBottomLeftRadius: 5,
      borderRight: 'none',
      color: BLACK_2,
      fontWeight: 500,
      paddingRight: theme.spacing(0),
      fontSize: '15px',
      lineHeight:'18px',
    }
  })
)(TableCell);

const TableCellEnd = withStyles((theme: Theme) =>
  createStyles({
    root: {
        border: `1px solid ${GREY}`,
        borderTopRightRadius: 5,
        borderBottomRightRadius: 5,
        borderLeft: 'none'
    }
  })
)(TableCell);

const TableCellMiddle = withStyles((theme: Theme) =>
  createStyles({
    root: {
      border: `1px solid ${GREY}`,
      borderRight: 'none',
      paddingRight: theme.spacing(0),
      borderLeft: 'none'
    }
  })
)(TableCell);

export { TableCellStart, TableCellEnd, TableCellMiddle };
