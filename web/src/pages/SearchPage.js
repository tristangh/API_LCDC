import React from 'react';
import { Container, Grid, TextField, Button, Paper, TableContainer, TableCell, TableRow, TableBody, TableHead, Table } from '@material-ui/core';
import Header from '../component/Header'

export default class AddPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            search: null,
            display: <div />
        }
        this.handleSearch = this.handleSearch.bind(this);
        this.onClick = this.onClick.bind(this);
        this.displayRes = this.displayRes.bind(this);
    }

    displayRes(json) {
        let other = <div />
        if (json.other)
            other = (
                <TableContainer component={Paper} style={{ paddingTop: 10 }}>
                    <Table aria-label="simple table">
                        <TableHead>
                            <TableRow>
                                <TableCell>Other musics from this artist</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {json.other.map((row) => (
                                <TableRow key={row.name}>

                                    <TableCell >{row.name}</TableCell>
                                    <TableCell >{row.artist}</TableCell>
                                    <TableCell >{row.album}</TableCell>
                                    <TableCell >{row.year}</TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>)
        if (json.match) {
            this.setState({
                display: (
                    <div>
                        <TableContainer component={Paper} style={{ paddingTop: 10 }}>
                            <Table aria-label="simple table">
                                <TableHead>
                                    <TableRow>
                                        <TableCell>Name</TableCell>
                                        <TableCell >Artist</TableCell>
                                        <TableCell >Album</TableCell>
                                        <TableCell >Year</TableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    <TableRow key={json.match.name}>
                                        <TableCell >{json.match.name}</TableCell>
                                        <TableCell >{json.match.artist}</TableCell>
                                        <TableCell >{json.match.album}</TableCell>
                                        <TableCell >{json.match.year}</TableCell>
                                    </TableRow>
                                </TableBody>
                            </Table>
                        </TableContainer>
                        {other}
                    </div>)
            })
        }
        else
            this.setState({
                display: <div>No results founds...</div>
            })
    }

    handleSearch(event) {
        event.preventDefault();
        this.setState({ search: event.target.value });
    }

    onClick() {
        let { search } = this.state;
        if (!search) {
            window.alert('A Name must be provide !!');
            return;
        }
        fetch("http://127.0.0.1:8080/api/search/" + search)
            .then(r => r.json())
            .then(json => { this.displayRes(json) });
    }

    render() {
        return (
            <div style={{ flexGrow: 1 }}>
                <Header page="Search" target="/add" />
                <Container style={{ paddingTop: 16 }}>
                    <Grid container justify="center">
                        <Grid item xs={12}>
                            <TextField
                                onKeyPress={(ev) => {
                                    if (ev.key === 'Enter') {
                                        // Do code here
                                        ev.preventDefault();
                                        this.onClick();
                                    }
                                }}
                                fullWidth
                                placeholder="Search Name..."
                                onChange={this.handleSearch}
                            />
                        </Grid>
                        <Grid item style={{ paddingTop: 10 }}>
                            <Button
                                onClick={this.onClick}
                            >
                                Search For This Music
                        </Button>
                        </Grid>
                    </Grid>
                    {this.state.display}
                </Container>
            </div>
        );
    }
}