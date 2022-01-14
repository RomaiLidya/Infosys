import React, { FC } from 'react';
import { TableRow, Checkbox } from '@material-ui/core';
import HeaderCell from './HeaderCell';
import { makeStyles } from '@material-ui/styles';
import CheckBoxOutlineBlankIcon from '@material-ui/icons/CheckBoxOutlineBlank';
import CheckBoxOutlinedUncompletedIcon from '@material-ui/icons/IndeterminateCheckBox';
import CheckBoxIcon from '@material-ui/icons/CheckBox';

interface Header {
  label: string;
  id?: string;
  pT?: string;
  pR?: string;
  pB?: string;
  pL?: string;
  verticalAlign?: 'top' | 'middle' | 'bottom';
  isCheckBox?: boolean;
  checked?: number[];
  rowsPerPage?: number;
  align?: 'left' | 'center' | 'right' | 'justify' | 'inherit' | undefined;
  sort?: boolean;
  handleCheckAll?: () => void;
}

interface Props {
  headers: Header[];
  height?: number | string;
  order?: 'asc' | 'desc';
  orderBy?: string;
  onRequestSort?: (event: React.MouseEvent<unknown>, property: string) => void;
}

const useStyles = makeStyles(theme => ({
  tableRow: (props: Props) => ({
    height: '20px'
  }),
  checkBox: {
    '&&:hover': {
      backgroundColor: 'transparent'
    }
  },
  checkBoxSize: {
    fontSize: '16px'
  }
}));

const HeaderRow: FC<Props> = props => {
  const classes = useStyles(props);
  const { headers, orderBy, order, onRequestSort } = props;

  const renderContent = () => {
    return headers.map(header => {
      const countChecked = header.checked && header.checked.length;
      const totalShouldBeChecked = header.rowsPerPage && header.rowsPerPage;
      const renderCheckBoxIcon = () => {
        if (countChecked !== 0) {
          if (countChecked !== totalShouldBeChecked) {
            return <CheckBoxOutlinedUncompletedIcon className={classes.checkBoxSize} />;
          } else {
            return <CheckBoxIcon className={classes.checkBoxSize} />;
          }
        }
      };
      return (
        <HeaderCell
          key={header.label}
          pL={header.pL}
          pR={header.pR}
          pT={header.pT}
          pB={header.pB}
          align={header.align}
          verticalAlign={header.verticalAlign}
          isCheckBox={header.isCheckBox}
          orderBy={orderBy}
          order={order}
          sort={header.sort}
          id={header.id}
          onRequestSort={onRequestSort!}
        >
          {header.isCheckBox ? (
            <Checkbox
              key={header.label}
              icon={<CheckBoxOutlineBlankIcon className={classes.checkBoxSize} />}
              checkedIcon={renderCheckBoxIcon()}
              edge='start'
              color='primary'
              className={classes.checkBox}
              checked={countChecked !== 0 ? true : false}
              tabIndex={-1}
              disableRipple
              onChange={header.handleCheckAll}
            />
          ) : (
            header.label
          )}
        </HeaderCell>
      );
    });
  };
  return <TableRow className={classes.tableRow}>{renderContent()}</TableRow>;
};

export default HeaderRow;
