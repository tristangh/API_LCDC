import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import IconButton from '@material-ui/core/IconButton';
import Add from '@material-ui/icons/Add'
import Search from '@material-ui/icons/Search'

const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
    },
    menuButton: {
        marginRight: theme.spacing(2),
    },
    title: {
        flexGrow: 1,
    },
}));

export default function ButtonAppBar(props) {
    const classes = useStyles();
    let icon;
    if (props.page === "Search")
        icon = <Add/>
    else
        icon = <Search/>
    return (
        <div className={classes.root}>
            <AppBar position="static">
                <Toolbar>
                    <IconButton edge="start" className={classes.menuButton} color="inherit" aria-label="menu"
                    onClick={()=> {window.location = props.target}}>
                        {icon}
                    </IconButton>
                    <Typography variant="h6" className={classes.title}>
                        {props.page}
                    </Typography>
                </Toolbar>
            </AppBar>
        </div>
    );
}