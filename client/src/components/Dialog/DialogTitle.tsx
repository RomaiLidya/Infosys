import React from 'react';
import { createStyles, Theme, withStyles, WithStyles, Typography } from '@material-ui/core';
import MuiDialogTitle from '@material-ui/core/DialogTitle';

const styles = (theme: Theme) =>
  createStyles({
    root: {
      margin: 0,
      padding: theme.spacing(2)
    }
  });

interface DialogTitleProps extends WithStyles<typeof styles> {
  id?: string;
  children: React.ReactNode;
}

const DialogTitle = withStyles(styles)((props: DialogTitleProps) => {
  const { children, classes, ...other } = props;
  return (
    <MuiDialogTitle disableTypography className={classes.root} {...other}>
      <Typography variant='h1'>{children}</Typography>
    </MuiDialogTitle>
  );
});

export default DialogTitle;
