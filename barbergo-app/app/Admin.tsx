import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  ScrollView,
  Button,
  Dimensions,
  Alert,
  TouchableOpacity,
} from 'react-native';
import { BarChart } from 'react-native-chart-kit';
import axios from 'axios';
import { useRouter } from 'expo-router';
import { styles } from '../components/styles/AdminStyles';
import { Ionicons } from '@expo/vector-icons';

const screenWidth = Dimensions.get('window').width;

interface ProductoStats {
  precio_promedio: number;
  precio_maximo: number;
  precio_minimo: number;
}

interface CitaStats {
  total: number;
  hoy: number;
  semana: number;
}

interface ReciboStats {
  total_recibos: number;
  monto_total: number;
}

const Admin = () => {
  const [stats, setStats] = useState<ProductoStats | null>(null);
  const [citaStats, setCitaStats] = useState<CitaStats | null>(null);
  const [reciboStats, setReciboStats] = useState<ReciboStats | null>(null);
  const [menuVisible, setMenuVisible] = useState(false);
  const router = useRouter();

  useEffect(() => {
    axios
      .get('http://192.168.20.207:8000/api/productos/estadisticas')
      .then((res) => setStats(res.data))
      .catch((err) => console.error(err));

    axios
      .get('http://192.168.20.207:8000/api/cita/estadisticas')
      .then((res) => setCitaStats(res.data))
      .catch((err) => console.error(err));

    axios
      .get('http://192.168.20.207:8000/api/recibos/estadisticas')
      .then((res) => setReciboStats(res.data))
      .catch((err) => console.error(err));
  }, []);

  const chartConfig = {
    backgroundColor: '#1c1c1e',
    backgroundGradientFrom: '#2a2a2a',
    backgroundGradientTo: '#2a2a2a',
    decimalPlaces: 2,
    color: (opacity = 1) => `rgba(255, 215, 0, ${opacity})`,
    labelColor: () => '#fff',
    barPercentage: 0.5,
  };

  const downloadPDF = async (endpoint: string, filename: string) => {
    try {
      await axios.get(`http://192.168.20.207:8000/api/${endpoint}`, {
        responseType: 'blob',
      });
      Alert.alert('Descarga', `Se descargó ${filename} correctamente.`);
    } catch (error) {
      console.error(`Error al descargar ${filename}:`, error);
      Alert.alert('Error', `No se pudo descargar ${filename}.`);
    }
  };

  const toggleMenu = () => {
    setMenuVisible(!menuVisible);
  };

  const goToUsuarios = () => {
    setMenuVisible(false);
    router.push('/usuarios');
  };

  const logout = () => {
    setMenuVisible(false);
    router.replace('/');
  };

  return (
    <ScrollView contentContainerStyle={styles.container}>
      {/* Header */}
      <View style={styles.header}>
        <Text style={styles.headerText}>Panel de Administración</Text>
        <TouchableOpacity onPress={toggleMenu}>
          <Ionicons name="menu" size={30} color="white" style={styles.menuIconRight} />
        </TouchableOpacity>
      </View>

      {/* Menu Hamburguesa */}
      {menuVisible && (
        <View style={styles.hamburgerMenuRight}>
          <Button title="Usuarios" onPress={goToUsuarios} />
          <Button title="Cerrar sesión" color="#d9534f" onPress={logout} />
        </View>
      )}

      {/* Estadísticas de Productos */}
      <Text style={styles.title}>Estadísticas de Productos</Text>
      <BarChart
        data={{
          labels: ['Promedio', 'Máximo', 'Mínimo'],
          datasets: [
            {
              data: stats
                ? [
                    stats.precio_promedio,
                    stats.precio_maximo,
                    stats.precio_minimo,
                  ]
                : [0, 0, 0],
            },
          ],
        }}
        width={screenWidth - 40}
        height={220}
        fromZero={true}
        yAxisLabel=""
        yAxisSuffix=""
        chartConfig={chartConfig}
        style={styles.chart}
      />
      <Button
        title="Descargar PDF Productos"
        onPress={() => downloadPDF('productos/estadisticas/pdf', 'productos')}
      />

      {/* Estadísticas de Citas */}
      <Text style={styles.title}>Estadísticas de Citas</Text>
      <BarChart
        data={{
          labels: ['Total', 'Hoy', 'Semana'],
          datasets: [
            {
              data: citaStats
                ? [citaStats.total, citaStats.hoy, citaStats.semana]
                : [0, 0, 0],
            },
          ],
        }}
        width={screenWidth - 40}
        height={220}
        fromZero={true}
        yAxisLabel=""
        yAxisSuffix=""
        chartConfig={{
          ...chartConfig,
          color: (opacity = 1) => `rgba(30, 144, 255, ${opacity})`,
        }}
        style={styles.chart}
      />
      <Button
        title="Descargar PDF Citas"
        onPress={() => downloadPDF('cita/estadisticas/pdf', 'citas')}
      />

      {/* Estadísticas de Recibos */}
      <Text style={styles.title}>Estadísticas de Recibos</Text>
      <BarChart
        data={{
          labels: ['Total', 'Monto Total'],
          datasets: [
            {
              data: reciboStats
                ? [reciboStats.total_recibos, reciboStats.monto_total]
                : [0, 0],
            },
          ],
        }}
        width={screenWidth - 40}
        height={220}
        fromZero={true}
        yAxisLabel=""
        yAxisSuffix=""
        chartConfig={{
          ...chartConfig,
          color: (opacity = 1) => `rgba(46, 139, 87, ${opacity})`,
        }}
        style={styles.chart}
      />
      <Button
        title="Descargar PDF Recibos"
        onPress={() => downloadPDF('recibos/pdf', 'recibos')}
      />

      {/* Footer */}
      <View style={styles.footer}>
        <Text style={styles.footerText}>© 2025 BAR-BER-GO</Text>
      </View>
    </ScrollView>
  );
};

export default Admin;
