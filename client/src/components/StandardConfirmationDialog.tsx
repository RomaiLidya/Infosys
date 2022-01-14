import React, { FC } from 'react';
import { Button, Dialog, DialogTitle, DialogContent, DialogActions, Grid, makeStyles, Theme, Typography, CircularProgress } from '@material-ui/core';
import SuccessIcon from '@material-ui/icons/CheckCircle';
import WarningIcon from '@material-ui/icons/Error';
import DeleteOutlineIcon from '@material-ui/icons/DeleteOutline';
import ErrorIcon from '@material-ui/icons/Close';
import { green } from '@material-ui/core/colors';
import { orange } from '@material-ui/core/colors';
import { red, blue } from '@material-ui/core/colors';

interface Props {
  variant: string;
  titleMessage?: string;
  message: string;
  open: boolean;
  handleClose(): void;
  onConfirm?: React.MouseEventHandler<HTMLButtonElement>;
  noCancelButton?: boolean;
  isLoading?: boolean;
}

const useStyles = makeStyles((theme: Theme) => ({
  successAvatarIcon: {
    fontSize: 60,
    color: green[500]
  },
  warnigAvatarIcon: {
    fontSize: 60,
    color: orange[500]
  },
  dangerAvatarIcon: {
    width: 54,
    height: 54,
    color: '#f44336'
  },
  cancelButton: (props: Props) => ({
    marginRight: theme.spacing(props.noCancelButton ? 0 : 3),
    color: '#FFFF'
  }),
  okButton: {
    backgroundColor: '#02A9EA',
    '&:hover': {
      backgroundColor: blue[700]
    }
  },
  dialogActions: {
    marginBottom: theme.spacing(2)
  },
  titleText: {
    paddingBottom: 2
  },
  messageText: {
    paddingBottom: theme.spacing(4)
  },
  iconGrid: {
    marginTop: 4
  }
}));

const StandardConfirmationDialog: FC<Props> = props => {
  const classes = useStyles(props);
  const { variant, titleMessage, message, open, isLoading, handleClose, onConfirm, noCancelButton } = props;

  return (
    <Dialog open={open}>
      <DialogTitle>
        <Grid container justify='center' alignItems='center' className={classes.iconGrid}>
          {variant === 'success' && <SuccessIcon className={classes.successAvatarIcon} />}
          {variant === 'warning' && <WarningIcon className={classes.warnigAvatarIcon} />}
          {variant === 'danger' && <DeleteOutlineIcon className={classes.dangerAvatarIcon} />}
          {variant === 'error' && <ErrorIcon className={classes.dangerAvatarIcon} />}
        </Grid>
      </DialogTitle>
      <DialogContent className={classes.titleText}>
        <Typography variant='h4' component='p' align={'center'}>
          {titleMessage}
        </Typography>
      </DialogContent>
      <DialogContent className={classes.messageText}>
        <Typography variant='h6' component='p' align={'center'}>
          {message}
        </Typography>
      </DialogContent>
      <DialogActions className={classes.dialogActions}>
        <Grid container justify='center' alignItems='center'>
          <Button
            disableElevation
            variant='contained'
            color={noCancelButton ? 'primary' : 'secondary'}
            className={classes.cancelButton}
            onClick={handleClose}
          >
            {noCancelButton ? 'Ok' : 'Batal'}
          </Button>
          {!noCancelButton && (
            <Button disableElevation variant='contained' disabled={isLoading} className={classes.okButton} onClick={onConfirm}>
              {isLoading ? <CircularProgress size={20} color='inherit' /> : 'Konfirmasi'}
            </Button>
          )}
        </Grid>
      </DialogActions>
    </Dialog>
  );
};

export default StandardConfirmationDialog;
