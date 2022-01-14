import React, { FC } from 'react';
import { Button, TextField, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle } from '@material-ui/core';

interface Props {
  open: boolean;
  password: string;
  setPassword: React.Dispatch<React.SetStateAction<string>>;
  passwordMessage: string;
  handleOnSubmit: () => void;
  handleClose: () => void;
}

const FormPasswordDialog: FC<Props> = props => {
  const { open, password, passwordMessage, setPassword, handleOnSubmit, handleClose } = props;

  return (
    <Dialog open={open} onClose={handleClose} aria-labelledby='form-dialog-title'>
      <DialogTitle id='form-dialog-title'>Konfirmasi Akses</DialogTitle>
      <DialogContent>
        <TextField
          autoFocus
          id='password'
          label='Kata Sandi'
          type='password'
          fullWidth
          value={password}
          onChange={e => setPassword(e.target.value)}
          error={passwordMessage !== ''}
          helperText={passwordMessage}
        />
      </DialogContent>
      <DialogActions>
        <Button onClick={handleClose} color='secondary'>
          Batal
        </Button>
        <Button onClick={handleOnSubmit} color='primary'>
          Konfirmasi
        </Button>
      </DialogActions>
    </Dialog>
  );
};

export default FormPasswordDialog;
