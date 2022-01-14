import React, { FC } from 'react';
import { TableRow, TablePagination as TablePaginationComponent } from '@material-ui/core';

interface Props {
  rowsPerPageOptions: number[];
  count: number;
  rowsPerPage: number;
  page: number;
  size?: 'small' | 'medium' | undefined;
  onChangePage: (event: React.MouseEvent<HTMLButtonElement> | null, page: number) => void;
  onChangeRowsPerPage: React.ChangeEventHandler<HTMLTextAreaElement | HTMLInputElement>;
}

const TablePagination: FC<Props> = props => {
  const { rowsPerPageOptions, count, rowsPerPage, page, size, onChangePage, onChangeRowsPerPage } = props;
  return (
    <TableRow>
      <TablePaginationComponent
        size={size}
        rowsPerPageOptions={rowsPerPageOptions}
        count={count}
        rowsPerPage={rowsPerPage}
        page={page}
        SelectProps={{
          inputProps: { 'aria-label': 'Rows per page' },
          native: true
        }}
        onChangePage={onChangePage}
        onChangeRowsPerPage={onChangeRowsPerPage}
        style={{ borderBottom: 'none' }}
      />
    </TableRow>
  );
};

export default TablePagination;
