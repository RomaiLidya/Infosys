import { withStyles, createStyles, Theme, Table } from '@material-ui/core';

const TableCustom = withStyles((theme: Theme) =>
  createStyles({
    root: {
      borderCollapse: 'separate',
      borderSpacing: '0 8px'
    }
  })
)(Table);

export default TableCustom;
