import { withStyles, createStyles, TableRow } from '@material-ui/core';

const TableRowCustom = withStyles(theme =>
  createStyles({
    root: {
      '&:hover': {
        background: '#F7F9FC',
        boxShadow: '0px 5px 12px rgba(0, 0, 0, 0.08)'
      }
    }
  })
)(TableRow);

export default TableRowCustom;
