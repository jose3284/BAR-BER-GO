import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  TextInput,
  Button,
  FlatList,
  ScrollView,
  StyleSheet,
} from 'react-native';
import axios from 'axios';

interface Usuario {
  idUsuario: number;
  Nombre: string;
  P_apellido: string;
  S_apellido: string;
  Pass: string;
  Correo: string;
  id_roles: number;
  userState: boolean;
}

const Usuarios = () => {
  const [usuarios, setUsuarios] = useState<Usuario[]>([]);
  const [formData, setFormData] = useState<Omit<Usuario, 'idUsuario'>>({
    Nombre: '',
    P_apellido: '',
    S_apellido: '',
    Pass: '',
    Correo: '',
    id_roles: 0,
    userState: true,
  });
  const [editId, setEditId] = useState<number | null>(null);

  const fetchUsuarios = async () => {
    try {
      const res = await axios.get('http://192.168.20.207:8000/api/usuarios');
      setUsuarios(res.data);
    } catch (err) {
      if (axios.isAxiosError(err)) {
        console.error('Error al obtener usuarios:', err.response?.data || err.message);
      } else {
        console.error('Error inesperado:', err);
      }
    }
  };

  useEffect(() => {
    fetchUsuarios();
  }, []);

  const handleChange = (name: keyof typeof formData, value: string | number | boolean) => {
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = async () => {
    try {
      if (editId) {
        await axios.put(`http://192.168.20.207:8000/api/usuarios/${editId}`, formData);
        setEditId(null);
      } else {
        await axios.post('http://192.168.20.207:8000/api/usuarios', formData);
      }
      fetchUsuarios();
      setFormData({
        Nombre: '',
        P_apellido: '',
        S_apellido: '',
        Pass: '',
        Correo: '',
        id_roles: 0,
        userState: true,
      });
    } catch (err) {
      if (axios.isAxiosError(err)) {
        console.error('Error al guardar usuario:', err.response?.data || err.message);
      } else {
        console.error('Error inesperado:', err);
      }
    }
  };

  const handleEdit = (usuario: Usuario) => {
    setFormData({
      Nombre: usuario.Nombre,
      P_apellido: usuario.P_apellido,
      S_apellido: usuario.S_apellido,
      Pass: '',
      Correo: usuario.Correo,
      id_roles: usuario.id_roles,
      userState: usuario.userState,
    });
    setEditId(usuario.idUsuario);
  };

  const handleDelete = async (id: number) => {
    try {
      const res = await axios.delete(`http://192.168.20.207:8000/api/usuarios/${id}`);
      console.log(res.data);
      fetchUsuarios();
    } catch (err) {
      if (axios.isAxiosError(err)) {
        console.error('Error al eliminar:', err.response?.data || err.message);
      } else {
        console.error('Error inesperado al eliminar:', err);
      }
    }
  };

  return (
    <ScrollView contentContainerStyle={styles.container}>
      <Text style={styles.title}>CRUD de Usuarios</Text>

      <TextInput
        placeholder="Nombre"
        style={styles.input}
        value={formData.Nombre}
        onChangeText={(text) => handleChange('Nombre', text)}
      />
      <TextInput
        placeholder="Primer Apellido"
        style={styles.input}
        value={formData.P_apellido}
        onChangeText={(text) => handleChange('P_apellido', text)}
      />
      <TextInput
        placeholder="Segundo Apellido"
        style={styles.input}
        value={formData.S_apellido}
        onChangeText={(text) => handleChange('S_apellido', text)}
      />
      <TextInput
        placeholder="Correo"
        style={styles.input}
        keyboardType="email-address"
        value={formData.Correo}
        onChangeText={(text) => handleChange('Correo', text)}
      />
      <TextInput
        placeholder="Contraseña"
        style={styles.input}
        secureTextEntry
        value={formData.Pass}
        onChangeText={(text) => handleChange('Pass', text)}
      />
      <TextInput
        placeholder="ID Rol"
        style={styles.input}
        keyboardType="numeric"
        value={formData.id_roles.toString()}
        onChangeText={(text) => handleChange('id_roles', Number(text))}
      />
      <TextInput
        placeholder="Estado (true o false)"
        style={styles.input}
        value={formData.userState.toString()}
        onChangeText={(text) => handleChange('userState', text === 'true')}
      />
      <Button title={editId ? 'Actualizar Usuario' : 'Guardar Usuario'} onPress={handleSubmit} />

      <Text style={styles.subtitle}>Lista de Usuarios</Text>
      <FlatList
        data={usuarios}
        keyExtractor={(item) => item.idUsuario.toString()}
        renderItem={({ item }) => (
          <View style={styles.userCard}>
            <Text>{item.Nombre} {item.P_apellido} - {item.Correo}</Text>
            <View style={styles.actions}>
              <Button title="Editar" onPress={() => handleEdit(item)} />
              <Button title="Eliminar" color="red" onPress={() => handleDelete(item.idUsuario)} />
            </View>
          </View>
        )}
      />
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    padding: 20,
    backgroundColor: '#1a1a1a',
    flexGrow: 1,
  },
  title: {
    fontSize: 24,
    color: '#fff',
    marginBottom: 20,
    textAlign: 'center',
  },
  subtitle: {
    fontSize: 20,
    color: '#fff',
    marginTop: 30,
  },
  input: {
    backgroundColor: '#fff',
    borderRadius: 8,
    padding: 10,
    marginBottom: 10,
  },
  userCard: {
    backgroundColor: '#333',
    padding: 10,
    marginVertical: 5,
    borderRadius: 8,
  },
  actions: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 10,
  },
});

export default Usuarios;
