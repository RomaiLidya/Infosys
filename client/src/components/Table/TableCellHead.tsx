import { withStyles, createStyles, Theme, TableCell } from '@material-ui/core';

const TableCellHead = withStyles((theme: Theme) =>
  createStyles({
    root: {
      color: '#BFC5D2',
      padding: '0px 10px 0px 0px',
      border: 'none',
      fontWeight: 500,
      fontSize: '12px',
      lineHeight: '14px',
      letterSpacing: '1.12px',
      textTransform: 'uppercase'
    }
  })
)(TableCell);

export default TableCellHead;
